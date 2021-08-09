<div id="ajaxModal" class="modal fade">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header over">
                <h4 class="modal-title">Add Role</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body" id="modalResponse">
                <div class="row">
                    <form action="{{ route('role.store') }}" method="POST">
                        @csrf
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="form-label">Name*</label>
                                <input type="text" value="{{ old('name', null) }}" name="name" class="form-control" id="name" placeholder="role name" required>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#ajaxModal').modal('show');
</script>


