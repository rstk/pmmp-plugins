#!/bin/bash

echo Starting to build plugins...

# Delete everything in plugins
rm -rf plugins/*
cd plugins

# Update DevTools.phar
wget "https://github.com/pmmp/DevTools/releases/latest/download/DevTools.phar" &> /dev/null

# Setup
mkdir tmp && cd tmp

# Get DevTools to build plugins
git clone "https://github.com/pmmp/DevTools" devtools &> /dev/null

# Get the plugins
git clone "https://github.com/rstk/pmmp-plugins" plugins &> /dev/null

# For every plugin, build it and put it in the plugins folder
cd plugins/src

# current path: %server%/plugins/tmp/plugins/src
for directoryName in */ ; do
	echo "Building ${directoryName%?}..."
	php -dphar.readonly=0 "../../devtools/src/DevTools/ConsoleScript.php" --make "$directoryName" --out "../../../${directoryName%?}.phar" &> /dev/null
done

# Self-update
cd "../../.."
rm -f build-plugins.sh
mv tmp/plugins/build-plugins.sh .

# Cleanup
rm -rf tmp

# Done
echo Finished building plugins!

# test