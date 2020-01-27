#!/bin/bash

build_name=$(date "+%Y%m%d%H%M%S")
build_root=public/build

find $build_root -type f -delete

css_root=public/css
cat \
    "${css_root}/app.css"\
    "${css_root}/style.css"\
    "${css_root}/lib/mdb.css"\
| yui-compressor --type css -o "${build_root}/${build_name}.css"

gzip -c -1 "${build_root}/${build_name}.css" > "${build_root}/${build_name}.cssgz"


js_root=public/js
cat \
    "${js_root}/lib/jquery.js"\
    "${js_root}/lib/bootstrap.bundle.js"\
    "${js_root}/lib/popper.min.js"\
    "${js_root}/lib/mdb.js"\
    "${js_root}/engine.js"\
| uglifyjs --compress --mangle -o "${build_root}/${build_name}.js"

gzip -c -1 "${build_root}/${build_name}.js" > "${build_root}/${build_name}.jsgz"




layout_file=resources/views/layouts/production_asserts.blade.php
perl -0pe "s/(build\/)(\d{14})(.)(js|css)/\1\L${build_name}\3\4/gms" $layout_file > /tmp/$build_name
cat /tmp/$build_name > $layout_file


