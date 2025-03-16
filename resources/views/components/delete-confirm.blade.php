<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="d-flex align-items-center justify-content-end p-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h5 class="fw-bold text-center text-danger" id="deleteModalLabel"><x-key-translate key="confirm_delete" /></h5>
                <p><x-key-translate key="delete_confirmation_message" /></p>
            </div>
            <div class="d-flex align-items-center justify-content-between p-3">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><x-key-translate key="cancel" /></button>
                <form id="deleteForm" action="" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><x-key-translate key="delete" /></button>
                </form>
            </div>
        </div>
    </div>
</div>