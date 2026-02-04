<?php include '../../layouts/verificacion.php'; ?>

<?php include '../../layouts/parte1.php'; ?>    


<style>
    .form-container {
        max-width: 800px;
        margin: 2rem auto;
        background: #fff;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .form-header {
        background: var(--admin-sidebar);
        padding: 20px 30px;
        color: white;
    }

    .form-body {
        padding: 30px;
    }

    .custom-label {
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #64748b;
        margin-bottom: 8px;
        display: block;
    }

    .form-control-custom {
        border: 1px solid #cbd5e1;
        padding: 12px;
        border-radius: 8px;
        transition: all 0.2s;
        font-size: 0.95rem;
    }

    .form-control-custom:focus {
        border-color: var(--admin-accent);
        box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
        outline: none;
    }

    .upload-area {
        border: 2px dashed #cbd5e1;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        cursor: pointer;
        transition: background 0.2s;
    }

    .upload-area:hover {
        background: #f8fafc;
        border-color: var(--admin-accent);
    }

    .btn-save {
        background-color: var(--admin-accent);
        color: white;
        padding: 12px 30px;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-save:hover {
        background-color: #ea580c;
        transform: translateY(-1px);
    }
</style>

<div class="container-fluid">
    <div class="form-container">
        <div class="form-header">
            <h3 class="bebas mb-0"><i class="fas fa-plus-circle me-2"></i> Registrar Nueva Universidad</h3>
        </div>

        <form action="../../../../app/controllers/controllers_coordinador/universidades/create.php" method="POST" enctype="multipart/form-data" class="form-body">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <label class="custom-label">Nombre de la Institución</label>
                    <input type="text" name="nombre_universidad" class="form-control form-control-custom" placeholder="Ej: Universidad Nacional de Básquet" required>
                </div>

                <div class="col-md-12 mb-4">
                    <label class="custom-label">Ubicación / Sede</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-map-marker-alt text-danger"></i></span>
                        <input type="text" name="ubicacion" class="form-control form-control-custom border-start-0" placeholder="Ciudad, Estado o Dirección" required>
                    </div>
                </div>

                <div class="col-md-12 mb-4">
                    <label class="custom-label">Logo / Escudo Institucional</label>
                    <div class="upload-area" onclick="document.getElementById('imagen').click()">
                        <i class="fas fa-cloud-upload-alt fa-2x mb-2" style="color: var(--admin-accent);"></i>
                        <p class="mb-0 text-muted small">Haga clic para seleccionar o arrastre el archivo aquí</p>
                        <input type="file" name="imagen" id="imagen" class="d-none" accept="image/*">
                    </div>
                </div>
            </div>

            <hr class="my-4" style="opacity: 0.1;">

            <div class="d-flex justify-content-end gap-2">
                <a href="index.php" class="btn btn-light border px-4">Cancelar</a>
                <button type="submit" class="btn btn-save">
                    <i class="fas fa-save me-2"></i> Guardar Universidad
                </button>
            </div>
        </form>
    </div>
</div>


<?php include '../../layouts/parte2.php'; ?>