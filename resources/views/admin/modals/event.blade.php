<div class="modal fade" id="addEventModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('events.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Location</label>
                        <input type="text" class="form-control" name="location" required>
                    </div>
                    <div class="mb-3">
                        <label>Event Date</label>
                        <input type="datetime-local" class="form-control" name="event_date" required>
                    </div>
                    <div class="mb-3">
                        <label>Capacity</label>
                        <input type="number" class="form-control" name="capacity" required>
                    </div>
                    <button type="submit" class="btn-admin w-100">Add Event</button>
                </form>
            </div>
        </div>
    </div>
</div> 