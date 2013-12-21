#!/bin/bash
#determine path
MY_PATH="`dirname \"$0\"`"              # relative
MY_PATH="`( cd \"$MY_PATH\" && pwd )`"  # absolutized and normalized
if [ -z "$MY_PATH" ] ; then
  # error; for some reason, the path is not accessible
  # to the script (e.g. permissions re-evaled after suid)
  exit 1  # fail
fi
cd "$MY_PATH"/app/

#get atributes
clear
echo -e "Which deploy stage? (i.e. staging, bv, prive) (default/empty - staging)\n"
read  deploystage

git pull
latesttag=$(git describe --tags $(git rev-list --tags --max-count=1))
clear
echo -e "Branches \n"
git branch -l

echo -e "\n\n Releases \n"
git tag -l

echo -e "Which branch / release (default/empty - $latesttag): \n"
read  branch

#read -e -p "Which branch / release (default/empty - latest release): " -i $latesttag branch


if [ ${#branch} -lt 1 ]; then
    branch=$latesttag
fi

if [ ${#deploystage} -lt 1 ]; then
    deploystage="staging"
fi
clear
echo "Check input:"
echo "Selected branch/ release: " $branch
echo "Selected stage: " $deploystage
echo "Press a key to resume"
read -n 1 -s
cap -s branch="$branch" $deploystage deploy

