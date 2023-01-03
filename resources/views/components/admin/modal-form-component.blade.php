<div>
    <div class="modal fade" id="modal-form">
        <div class="modal-dialog">
    
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                </div>
    
                <div class="modal-body">
                    {{ $modalBody }}
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="store()" id="btnSave">Save</button>
                </div>
            </div>
    
        </div>
    </div>
</div>