@echo off
echo ========================================
echo    Pushing Changes to GitHub
echo ========================================

echo.
echo Checking for changes...
git status

echo.
echo Adding all changes...
git add .

echo.
echo Committing changes...
set /p commit_message="Enter commit message (or press Enter for default): "
if "%commit_message%"=="" set commit_message="Update project files"

git commit -m %commit_message%

echo.
echo Pushing to GitHub...
git push origin main

echo.
echo ========================================
echo    Push Complete!
echo ========================================
pause 