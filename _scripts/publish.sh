#!/bin/bash
set -e
bundle exec jekyll build
lftp -c "set dns:order \"inet\" ; set ftp:ssl-allow no ; open ftp://$FTP_HOST ; user $FTP_USER $FTP_PASSWORD ; mirror -R _site $FTP_PATH ; exit"
