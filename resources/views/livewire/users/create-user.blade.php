<div>
    @section('title', 'Create user')
    <div class="d-flex py-2">
        <h2>Alumno</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent='createUser' onsubmit="event.preventDefault();">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <p>Nombre de usuario:</p>
                            <input type="text" id="nombres" class="form-control" wire:model="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <p>Email:</p>
                            <input type="text" id="email" class="form-control" wire:model="email" onblur="anadirCorreo(event)">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <p>Contraseña temporal:</p>
                            <input type="password" class="form-control" wire:model="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col form-group">
                            <p>Enlace:</p>
                            <input type="text" class="form-control" wire:model='enlace'>
                            @error('enlace')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <p>Asignar perfil:</p>
                            <select class="form-select" name="perfil" id="perfil" wire:model="perfil" onchange="actualizarURL(event)">
                                <option value="">Seleccione una opcion.....</option>
                                @foreach ($perfiles as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('perfil')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <p>Telefono:</p>
                            <input type="text" class="form-control" wire:model='telefono'>
                            @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                      
                    <div class="row mt-3">
                        <div class="col">
                            <p>Creación de tienda: </p>
                            <input type="text" id="url_tienda" name="url_tienda" wire:model="url_tienda"  disabled  class="form-control" >
                            @error('url_tienda')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
     function generarToken() {
    return Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
}

// Generar token una sola vez cuando la página se carga
let tokenGlobal = generarToken();

function actualizarURL() {
    var perfil = document.getElementById('perfil').value;
    var url = "https://registro.imporsuit.com/registro_tienda.php?premium=";
    let premium;
    if(perfil == 3 || perfil == 4 || perfil == 5) {
        premium = 3;
    } else if(perfil == 6 || perfil == 7) {
        premium = 2;
    } else {
        premium = 1;
    }
    let url_tienda = document.getElementById('url_tienda');
    if(document.getElementById('email').value == "") {
        url_tienda.value = url + premium + "&token=" + tokenGlobal;
    } else {
        url_tienda.value = url + premium + "&token=" + tokenGlobal + "&correo=" + document.getElementById('email').value;
    }
    var event = new CustomEvent('url-tienda-update', { detail: url_tienda.value });
    window.dispatchEvent(event);
}

function anadirCorreo(e) {
    var correo = e.target.value;
    var url_tienda = document.getElementById('url_tienda');
    let urlBase = url_tienda.value.split('&token=')[0];
    url_tienda.value = urlBase + "&token=" + tokenGlobal + "&correo=" + correo;
    var event = new CustomEvent('url-tienda-update', { detail: url_tienda.value });
    window.dispatchEvent(event);
}

// Llamar a actualizarURL al cargar la página para inicializar la URL
document.addEventListener('DOMContentLoaded', (event) => {
    actualizarURL();
    const url_tienda = document.getElementById('url_tienda');
    url_tienda.focus();
    
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.addEventListener('url-tienda-update', event => {
            @this.call('urlTiedaUpdated', event.detail)
        })
    });
</script>

    <style>
        #card {
            filter: blur(2px);
            /* Aplica un desenfoque al elemento card */
        }

        #card form * {
            pointer-events: none;
            /* Desactiva la interacción con elementos del formulario */
            opacity: 0.8;
            /* Reduce la opacidad para dar el efecto de desenfoque */
        }
    </style>
</div>
