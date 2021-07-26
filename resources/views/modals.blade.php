<!-- Modal -->
<div class="modal fade" id="dataSend" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Point</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" id="formData" action="/api/save" enctype="multipart/form-data"></form>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="">
                <input type="text" hidden id="x">
                <input type="text" hidden id="y">
              </div>

              <div class="form-group">
                <label for="image">Upload Image</label>
                <input class="form-control" type="file"  id="image">
              </div>

            <div class="form-group">
                <label for="note">Note</label>
                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
            </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" data-bs-dismiss="modal" onclick="sendForm(sessionStorage.getItem('sym'),sessionStorage.getItem('color'))" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>

<!-- UPLOAD PDF -->
<div class="modal fade" id="uploadPdf" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new Map</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post"  action="/api/save" enctype="multipart/form-data"></form>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="map_name" placeholder="">
                <input type="text" hidden id="x">
                <input type="text" hidden id="y">
              </div>

              <div class="form-group">
                <label for="image">Upload PDF</label>
                <input class="form-control" type="file"  id="map_pdf">
              </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" data-bs-dismiss="modal" onclick="uploadPdf()" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>

<!-- UPLOAD PDF -->