pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                // gunakan checkout scm supaya Jenkins ambil repo & branch tempat Jenkinsfile berada
                checkout scm
            }
        }

        stage('Info') {
            steps {
                script {
                    if (isUnix()) {
                        sh 'echo "Running on Unix-like agent"; php -v || true'
                    } else {
                        bat 'echo Running on Windows agent && php -v || echo no-php'
                    }
                }
            }
        }

        stage('Run PHP if exists') {
            steps {
                script {
                    if (isUnix()) {
                        sh '''
                        if [ -f index.php ]; then
                          echo "Found index.php — running php index.php"
                          php index.php || true
                        else
                          echo "index.php not found — skipping run"
                        fi
                        '''
                    } else {
                        bat '''
                        if exist index.php (
                          echo Found index.php - running php index.php
                          php index.php || echo php-returned-error
                        ) else (
                          echo index.php not found - skipping
                        )
                        '''
                    }
                }
            }
        }
    }

    post {
        always { echo "Pipeline finished." }
    }
}
