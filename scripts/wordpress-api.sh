#!/usr/bin/env bash
set -euo pipefail

API="${WORDPRESS_URL%/}/wp-json/codex-bridge/v1"
AUTH="${WORDPRESS_USERNAME}:${WORDPRESS_APP_PASSWORD}"

curl_api() {
  curl --silent --show-error --fail-with-body --user "$AUTH" "$@"
}

case "${1:-help}" in
  health)
    curl_api "$API/health"
    ;;
  pages)
    curl_api "$API/posts?post_type=page&per_page=100"
    ;;
  services)
    curl_api "$API/posts?post_type=service&per_page=100"
    ;;
  posts)
    curl_api "$API/posts?post_type=post&per_page=100"
    ;;
  case-studies)
    curl_api "$API/posts?post_type=case_study&per_page=100"
    ;;
  find)
    curl_api --get --data-urlencode "search=${2:-}" "$API/posts"
    ;;
  get)
    curl_api "$API/posts/$2"
    ;;
  seo)
    curl_api "$API/posts/$2/seo"
    ;;
  acf)
    curl_api "$API/posts/$2/acf"
    ;;
  create)
    curl_api -X POST -H "Content-Type: application/json" --data-binary @"$2" "$API/posts"
    ;;
  update)
    curl_api -X PATCH -H "Content-Type: application/json" --data-binary @"$3" "$API/posts/$2"
    ;;
  update-seo)
    curl_api -X PATCH -H "Content-Type: application/json" --data-binary @"$3" "$API/posts/$2/seo"
    ;;
  update-acf)
    curl_api -X PATCH -H "Content-Type: application/json" --data-binary @"$3" "$API/posts/$2/acf"
    ;;
  custom-fields)
    curl_api "$API/posts/$2/service-fields"
    ;;
  update-custom-fields)
    curl_api -X PATCH -H "Content-Type: application/json" --data-binary @"$3" "$API/posts/$2/service-fields"
    ;;
  project-fields)
    curl_api "$API/posts/$2/project-fields"
    ;;
  update-project-fields)
    curl_api -X PATCH -H "Content-Type: application/json" --data-binary @"$3" "$API/posts/$2/project-fields"
    ;;
  sync-service-fields)
    catalog="$(mktemp)"
    payload="$(mktemp)"
    response="$(mktemp)"
    trap 'rm -f "$catalog" "$payload" "$response"' EXIT
    curl_api "$API/posts?post_type=service&per_page=100" > "$catalog"
    python3 - "$catalog" "$2" <<'PY' | while IFS=$'\t' read -r post_id slug; do
import json
import sys

catalog = json.load(open(sys.argv[1], encoding='utf-8'))
fields = json.load(open(sys.argv[2], encoding='utf-8'))
ids = {item['slug']: item['id'] for item in catalog['items']}
missing = sorted(set(fields) - set(ids))
if missing:
    raise SystemExit('Services not found in WordPress: ' + ', '.join(missing))
for slug in fields:
    print(f"{ids[slug]}\t{slug}")
PY
      python3 - "$2" "$slug" "$payload" <<'PY'
import json
import sys

fields = json.load(open(sys.argv[1], encoding='utf-8'))
with open(sys.argv[3], 'w', encoding='utf-8') as output:
    json.dump({'fields': fields[sys.argv[2]]['meta']}, output, ensure_ascii=False)
PY
      curl_api -X PATCH -H "Content-Type: application/json" --data-binary @"$payload" "$API/posts/$post_id/service-fields" > "$response"
      python3 - "$payload" "$response" "$slug" <<'PY'
import json
import sys

expected = json.load(open(sys.argv[1], encoding='utf-8')).get('fields', {})
actual_response = json.load(open(sys.argv[2], encoding='utf-8'))
actual = actual_response.get('fields')
slug = sys.argv[3]

if actual is None:
    raise SystemExit(
        f'{slug}: WordPress Bridge did not return service fields; '
        'deploy the theme version that registers the service-fields route before syncing'
    )

mismatches = [name for name, value in expected.items() if actual.get(name) != value]
if mismatches:
    raise SystemExit(f'{slug}: custom-field verification failed: {", ".join(mismatches)}')

print(json.dumps({'id': actual_response['id'], 'slug': slug, 'fields_updated': len(expected)}))
PY
    done
    ;;
  media-upload)
    file="${2:-}"
    if [[ -z "$file" || ! -f "$file" ]]; then
      echo "media-upload: file not found: $file" >&2
      exit 2
    fi
    shift 2
    args=(-X POST -F "file=@$file")
    for opt in "$@"; do
      case "$opt" in
        --post-id=*) args+=(-F "post_id=${opt#*=}") ;;
        --alt=*) args+=(-F "alt=${opt#*=}") ;;
        --title=*) args+=(-F "title=${opt#*=}") ;;
        --caption=*) args+=(-F "caption=${opt#*=}") ;;
        --description=*) args+=(-F "description=${opt#*=}") ;;
        --set-featured) args+=(-F "set_featured=1") ;;
        *) echo "media-upload: unknown option: $opt" >&2; exit 2 ;;
      esac
    done
    curl_api "${args[@]}" "$API/media/upload"
    ;;
  thumbnail)
    curl_api -X PATCH -H "Content-Type: application/json" --data-binary "{\"attachment_id\":${3:-0}}" "$API/posts/$2/thumbnail"
    ;;
  scan-links)
    curl_api -X POST "$API/links/scan"
    ;;
  audit)
    curl_api "$API/audit"
    ;;
  help|*)
    echo "health pages posts services case-studies find get seo acf custom-fields create update update-seo update-acf update-custom-fields project-fields update-project-fields sync-service-fields media-upload thumbnail scan-links audit"
    ;;
esac
