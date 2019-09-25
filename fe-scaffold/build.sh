#!/bin/bash
webpack --mode production
mv ./dist/js/bundle.js ../js/
mv ./dist/js/bundle.js.map ../js/
mv ./dist/css/bundle.css ../css/main.css
mv ./dist/css/bundle.css.map ../css/main.css.map
mv ./dist/css/editor.css ../css/
mv ./dist/css/editor.css.map ../css/
mv ./dist/css/styleguide.css ../css/
mv ./dist/css/styleguide.css.map ../css/
mv ./dist/*.svg ../css/
mv ./dist/*.png ../css/
mv ./dist/*.jpg ../css/
