function fetchFlightData(id) {
    fetch(`/${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('planeCodeUpd').value = data.codigo_avion;
            document.getElementById('flightDateUpd').value = data.fecha;
            document.getElementById('hourUpd').value = data.hora;
            document.getElementById('type').value = data.tipo;
            document.getElementById('costUpd').value = data.costo;
            document.getElementById('destinationUpd').value = data.destino;
            document.getElementById('elementId').value = `${id}`;
        })
        .catch(error => console.error('Error fetching flight data:', error));
}

function updateFlight() {
    const id = document.getElementById('elementId').value;
    const formData = new FormData();
    formData.append('id', id);
    formData.append('planeCode', document.getElementById('planeCodeUpd').value);
    formData.append('flightDate', document.getElementById('flightDateUpd').value);
    formData.append('hour', document.getElementById('hourUpd').value);
    formData.append('type', document.getElementById('typeUpd').value);
    formData.append('cost', document.getElementById('costUpd').value);
    formData.append('destination', document.getElementById('destinationUpd').value);

    fetch(`/${id}`, {
        method: 'PUT',
        body: JSON.stringify({
            id: id,
            planeCode: document.getElementById('planeCodeUpd').value,
            flightDate: document.getElementById('flightDateUpd').value,
            hour: document.getElementById('hourUpd').value,
            type: document.getElementById('typeUpd').value,
            cost: document.getElementById('costUpd').value,
            destination: document.getElementById('destinationUpd').value
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            console.log('Flight updated successfully:', data);
            $('#updateModal').modal('hide');
            location.reload();
        })
        .catch(error => {
            console.error('Error updating flight:', error);
        });
}

function deleteFlight(id) {
    fetch(`/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            console.log('Flight deleted successfully:', data);
            location.reload();
        })
        .catch(error => {
            console.error('Error deleting flight:', error);
        });
}
