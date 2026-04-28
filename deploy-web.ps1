# Script manual de despliegue para Mentally Web en Azure Container Apps
# Ejecutar desde la raiz del proyecto Laravel

$ErrorActionPreference = "Stop"
$AZ = "C:\Program Files\Microsoft SDKs\Azure\CLI2\wbin\az.cmd"

# Configuracion base
$RESOURCE_GROUP = "mentally-prod-rg"
$CONTAINER_APP = "mentally-web"
$ACR_NAME = "mentallyacr29870e64"
$IMAGE_NAME = "mentally-web"
$TAG = "manual-$(Get-Date -Format 'yyyyMMdd-HHmm')"

$ACR_LOGIN_SERVER = "$ACR_NAME.azurecr.io"
$FULL_IMAGE_NAME = "$ACR_LOGIN_SERVER/$IMAGE_NAME`:$TAG"

function Run-Step {
    param (
        [string]$Message,
        [scriptblock]$Command
    )

    Write-Host ""
    Write-Host $Message

    & $Command

    if ($LASTEXITCODE -ne 0) {
        throw "Error en: $Message"
    }
}

try {
    Write-Host "========================================"
    Write-Host " Despliegue manual de Mentally Web"
    Write-Host "========================================"
    Write-Host "Resource Group: $RESOURCE_GROUP"
    Write-Host "Container App:  $CONTAINER_APP"
    Write-Host "Imagen:         $FULL_IMAGE_NAME"
    Write-Host "========================================"

    Run-Step "Paso 1/4: Login en Azure Container Registry..." {
        & $AZ acr login --name $ACR_NAME
    }

    Run-Step "Paso 2/4: Construyendo imagen Docker..." {
        docker buildx build `
            --platform linux/amd64 `
            --provenance=false `
            -f Dockerfile.prod `
            -t $FULL_IMAGE_NAME `
            --load `
            .
    }

    Run-Step "Paso 3/4: Subiendo imagen al ACR..." {
        docker push $FULL_IMAGE_NAME
    }

    Run-Step "Paso 4/4: Actualizando Azure Container App..." {
        & $AZ containerapp update `
            --name $CONTAINER_APP `
            --resource-group $RESOURCE_GROUP `
            --image $FULL_IMAGE_NAME
    }

    Write-Host ""
    Write-Host "Despliegue finalizado correctamente."
    Write-Host "Nueva imagen desplegada:"
    Write-Host $FULL_IMAGE_NAME
}
catch {
    Write-Host ""
    Write-Host "El despliegue se detuvo por un error."
    Write-Host $_.Exception.Message
    exit 1
}