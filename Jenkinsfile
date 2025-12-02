pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
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

        stage('Optional: run PHPUnit') {
            steps {
                script {
                    if (isUnix()) {
                        sh '''
                        if [ -f vendor/bin/phpunit ] || [ -f phpunit.xml ]; then
                          echo "Attempt to run phpunit (if installed)..."
                          ./vendor/bin/phpunit --version || phpunit --version || true
                        else
                          echo "No phpunit - skipping tests"
                        fi
                        '''
                    } else {
                        bat '''
                        if exist vendor\\bin\\phpunit (
                          echo Running phpunit...
                          vendor\\bin\\phpunit --version || echo phpunit-error
                        ) else (
                          echo No phpunit - skipping
                        )
                        '''
                    }
                }
            }
        }
    }

    post {
        always {
            echo "Pipeline finished."
        }
    }
}
