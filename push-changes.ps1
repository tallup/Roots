# PowerShell script to push changes to GitHub
Write-Host "========================================" -ForegroundColor Green
Write-Host "    Pushing Changes to GitHub" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green

Write-Host "`nChecking for changes..." -ForegroundColor Yellow
git status

Write-Host "`nAdding all changes..." -ForegroundColor Yellow
git add .

Write-Host "`nCommitting changes..." -ForegroundColor Yellow
$commitMessage = Read-Host "Enter commit message (or press Enter for default)"
if ([string]::IsNullOrWhiteSpace($commitMessage)) {
    $commitMessage = "Update project files"
}

git commit -m $commitMessage

Write-Host "`nPushing to GitHub..." -ForegroundColor Yellow
git push origin main

Write-Host "`n========================================" -ForegroundColor Green
Write-Host "    Push Complete!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green

Read-Host "Press Enter to continue" 