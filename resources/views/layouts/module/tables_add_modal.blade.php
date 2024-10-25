<div class="modal fade" id="addTableModal" tabindex="-1" aria-labelledby="addTableModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Genişletilmiş modal -->
        <div class="modal-content">
            <form action="{{ route('tables.add') }}" method="POST" id="addTableForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addTableModalLabel">Yeni Masa Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <table class="table" id="tableFields">
                        <thead>
                            <tr>
                                <th>Masa Numarası / Masa Adı</th>
                                <th>Kapasite</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" class="form-control" name="name[]" required></td>
                                <td><input type="number" class="form-control" name="capacity[]" required></td>
                                <td>
                                    <button type="button" class="btn btn-danger removeField">Kaldır</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary mt-3" id="addMoreFields">Yeni masa ekle <i class="fas fa-plus"></i></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-success">Ekle</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('addMoreFields').addEventListener('click', function() {
        const tableFields = document.getElementById('tableFields').getElementsByTagName('tbody')[0];

        const newRow = `
            <tr>
                <td><input type="text" class="form-control" name="name[]" required></td>
                <td><input type="number" class="form-control" name="capacity[]" required></td>
                <td>
                    <button type="button" class="btn btn-danger removeField">Kaldır</button>
                </td>
            </tr>
        `;

        tableFields.insertAdjacentHTML('beforeend', newRow);
    });

    document.getElementById('tableFields').addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('removeField')) {
            const row = e.target.closest('tr');
            row.remove();
        }
    });
</script>

<style>
    .modal-body {
        width: 100%;
    }

    .modal-lg {
        max-width: 80%;
    }

    .modal-lg .modal-content {
        max-height: calc(100vh - 100px);
        overflow-y: auto;
    }
</style>