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
    echo "health pages posts case-studies find get seo acf create update update-seo update-acf media-upload thumbnail scan-links audit"
    ;;
esac
