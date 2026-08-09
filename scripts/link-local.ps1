<#
  Creates the directory junctions needed to make WordPress see this repo's
  content when it's cloned inside wp-content/<repo-name>/.

  Usage: open PowerShell in this script's folder (or anywhere) and run:
    .\link-local.ps1

  Does not require administrator privileges (unlike symlinks, junctions
  don't need elevation on Windows).
#>

$repoRoot  = Split-Path -Parent $PSScriptRoot
$wpContent = Split-Path -Parent $repoRoot

# Every folder under the repo's themes/ gets its own junction, so new
# themes are picked up automatically without editing this script.
$links = @(
    Get-ChildItem -Path (Join-Path $repoRoot "themes") -Directory | ForEach-Object {
        @{ Link = Join-Path $wpContent "themes\$($_.Name)"; Target = $_.FullName }
    }
    @{ Link = Join-Path $wpContent "mu-plugins"; Target = Join-Path $repoRoot "mu-plugins" }
)

foreach ($l in $links) {
    if (Test-Path $l.Link) {
        Write-Host "Skip (already exists): $($l.Link)"
        continue
    }
    if (-not (Test-Path $l.Target)) {
        Write-Warning "Target missing, skipping: $($l.Target)"
        continue
    }
    New-Item -ItemType Junction -Path $l.Link -Target $l.Target | Out-Null
    Write-Host "Created: $($l.Link) -> $($l.Target)"
}
