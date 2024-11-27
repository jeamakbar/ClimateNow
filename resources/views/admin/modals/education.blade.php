<div class="modal fade" id="addEducationModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Educational Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('education.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label>Category</label>
                        <select class="form-control" name="category" required>
                            <option value="pemanasan_global">Pemanasan Global</option>
                            <option value="energi_terbarukan">Energi Terbarukan</option>
                            <option value="konservasi">Konservasi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Difficulty</label>
                        <select class="form-control" name="difficulty" required>
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="advanced">Advanced</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image" required>
                    </div>
                    <button type="submit" class="btn-admin w-100">Add Material</button>
                </form>
            </div>
        </div>
    </div>
</div> 