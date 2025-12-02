pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                git branch: 'main', url: 'https://github.com/AzharRizky05/praktikum10-AzharRizky'
            }
        }

        stage('Run PHP') {
            steps {
                powershell 'php index.php'
            }
        }
    }
}
