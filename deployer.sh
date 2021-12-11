set -e

echo "Deploying application ..."

(php artisan down --message 'The app is being (quickly!) update. please tring agin')

git pull origin main

php artisan up

echo "application deployed!"