<div class="modal fade" id="createRecordMod" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Flight</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form method="post" action="/">
                        <div class="row">
                            <div class="mb-3">
                                <label for="planeCode" class="form-label">Airplane Code</label>
                                <input type="text" class="form-control" id="planeCode" name="planeCode">
                            </div>
                            <div class="mb-3">
                                <label for="flightDate" class="form-label">Flight Date</label>
                                <input type="date" class="form-control" id="flightDate" name="flightDate">
                            </div>
                            <div class="mb-3">
                                <label for="hour" class="form-label">Flight Time</label>
                                <input type="text" class="form-control" id="hour" name="hour">
                            </div>
                            <div class="mb-3">
                                <select class="form-control" name="type">
                                    <option selected>Select the Flight Type</option>
                                    <option value="1">Direct Flight</option>
                                    <option value="2">Stopover Flight</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cost" class="form-label">Total Cost</label>
                                <input type="number" class="form-control" id="cost" name="cost">
                            </div>
                            <div class="mb-3">
                                <label for="hour" class="form-label">Destination</label>
                                <input type="text" class="form-control" id="destination" name="destination">
                            </div>
                            <button type="submit" class="btn btn-primary">Save Flight</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="updateForm">
                        <input type="hidden" id="flightId" name="id">
                        <div class="row">
                            <div class="mb-3">
                                <label for="planeCodeUpd" class="form-label">Airplane Code</label>
                                <input type="text" class="form-control" id="planeCodeUpd" name="planeCode">
                            </div>
                            <div class="mb-3">
                                <label for="flightDateUpd" class="form-label">Flight Date</label>
                                <input type="date" class="form-control" id="flightDateUpd" name="flightDate">
                            </div>
                            <div class="mb-3">
                                <label for="hourUpd" class="form-label">Flight Time</label>
                                <input type="text" class="form-control" id="hourUpd" name="hour">
                            </div>
                            <div class="mb-3">
                                <select class="form-control" name="typeUpd" id="typeUpd">
                                    <option selected>Select the Flight Type</option>
                                    <option value="1">Direct Flight</option>
                                    <option value="2">Stopover Flight</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="costUpd" class="form-label">Total Cost</label>
                                <input type="number" class="form-control" id="costUpd" name="cost">
                            </div>
                            <div class="mb-3">
                                <label for="destinationUpd" class="form-label">Destination</label>
                                <input type="text" class="form-control" id="destinationUpd" name="destination">
                            </div>
                            <input type="text" id="elementId" hidden>
                            <button type="button" class="btn btn-primary" onclick="updateFlight()">Update Flight</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>