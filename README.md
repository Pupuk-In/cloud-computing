# Cloud Computing Documentation

## Database Design
![ERD](https://github.com/Pupuk-In/cloud-computing/assets/87064650/161575ff-16c9-4e9e-8a23-a501b6f37dc5)

<br>

# Steps to produce

### Clone the repository
Clone the repository from [here](https://github.com/Pupuk-In/cloud-computing.git)

### Setup your Google Cloud SQL and Cloud Storage
- Configure your [Cloud SQL](https://cloud.google.com/sql) to use PostgreSQL
- Configure your [Cloud Storage](https://cloud.google.com/storage) to standard storage
- Make a [Service Account](https://cloud.google.com/iam/docs/service-account-overview) to interact with your [Cloud Storage](https://cloud.google.com/storage), then make a key in the form of a JSON

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
- Setup your cloud run environment with continuous build from [Cloud Build](https://cloud.google.com/build) using [Triggers](https://cloud.google.com/build/docs/triggers), which will be run when a push is done to your repository
- Don't forget to set your Environment Variables and disclose your Secret Environment Variables using [Secret Manager](https://cloud.google.com/secret-manager)

### Setup ML Model Deployment using Cloud Run CI/CD
- Setup your cloud run environment with continuous build from [Cloud Build](https://cloud.google.com/build) using [Triggers](https://cloud.google.com/build/docs/triggers), which will be run when a push is done to your repository

<br>
<br>

# API Specification Documentation
for our API Specification list, [click here](https://github.com/Pupuk-In/cloud-computing.git)

