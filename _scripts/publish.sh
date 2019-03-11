#!/bin/bash
set -e
bundle exec jekyll build
cd _site
rm -f site.zip
zip -r site.zip .
lftp -c "set dns:order \"inet\" ; open ftp://$FTP_HOST ; user $FTP_USER $FTP_PASSWORD ; put -e -O public_html site.zip ; exit"
curl $UNPACK_URL
