# Cloud Computing Documentation

## Database Design
![ERD](https://github.com/Pupuk-In/cloud-computing/assets/87064650/161575ff-16c9-4e9e-8a23-a501b6f37dc5)

<br>

## Steps to produce

### Clone the repository
Clone the repository from <a href="https://github.com/Pupuk-In/cloud-computing.git" target="_blank">here</a>

### Setup your Google Cloud SQL and Cloud Storage
- Configure your <a href="https://cloud.google.com/sql" target="_blank">Cloud SQL</a> to use PostgreSQL
- Configure your <a href="https://cloud.google.com/storage" target="_blank">Cloud Storage</a> to standard storage
- Make a service account to interact with your <a href="https://cloud.google.com/storage" target="_blank">Cloud Storage</a>, then make a key in the form of a JSON

### Setup your Cloned Laravel Project
- Go to your cloned repository directory
- Do `npm install`
- Do `composer install`
- Do `cp .env.example .env` then copy your database environment variables into it
- Do `npm run dev`
- Do `php artisan key:generate`
- Do `php artisan migrate`
- Optionally, do `php artisan db:seed` to automatically input dummy data into the database
- Finally, do `php artisan serve` to make your project locally live

### Setup your deployment using Cloud Run CI/CD
- Setup your cloud run environment with continuous build from <a href="https://cloud.google.com/build" target="_blank">Cloud Build</a> using <a href="https://cloud.google.com/build/docs/triggers" target="_blank">Triggers</a>, which will be run when a push is done to your repository
- Don't forget to set your Environment Variables and disclose your Secret Environment Variables using <a href="https://cloud.google.com/secret-manager" target="_blank">Secret Manager</a>

### Setup ML Model Deployment using Cloud Run CI/CD
- Setup your cloud run environment with continuous build from <a href="https://cloud.google.com/build" target="_blank">Cloud Build</a> using <a href="https://cloud.google.com/build/docs/triggers" target="_blank">Triggers</a>, which will be run when a push is done to your repository

<br>
<br>

# API Specification Documentation
for our API Specification list, <a href="https://github.com/Pupuk-In/cloud-computing.git" target="_blank">click here</a>
