<div>
    <!-- Botón flotante -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <button id="floatingButton" style="position: fixed; bottom: 20px; right: 20px; background-color: #007bff; color: white; border: none; border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
    <i class="fas fa-search" style="font-size: 24px;"></i>
</button>

<!-- Modal -->
<div id="instructionsModal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
    <div class="modal-content" style="background-color: white; padding: 20px; border-radius: 8px; width: 90%; max-width: 600px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
        <span class="close" onclick="closeModal()" style="cursor: pointer; float: right; font-size: 24px;">&times;</span>
        <h4 style="margin-bottom: 10px; font-size: 24px; font-weight: bold; color: #007bff;">📝 Instrucciones para el Proceso</h4>
        <ol style="font-size: 18px; line-height: 1.6;">
            <li style="margin-bottom: 10px;">🔍 <strong>Paso 1:</strong> Reúne todos los documentos necesarios para la auditoría.</li>
            <li style="margin-bottom: 10px;">💻 <strong>Paso 2:</strong> Accede al sistema y asegúrate de que tu conexión a Internet esté activa.</li>
            <li style="margin-bottom: 10px;">✅ <strong>Paso 3:</strong> Marca cada casilla de verificación según los hallazgos encontrados.</li>
            <li style="margin-bottom: 10px;">📤 <strong>Paso 4:</strong> Envía el informe final a través del botón correspondiente.</li>
            <li style="margin-bottom: 10px;">🎉 <strong>Paso 5:</strong> ¡Celebra tu trabajo bien hecho!</li>
        </ol>
    </div>
</div>
</div>

<script>
// Función para abrir el modal
document.getElementById('floatingButton').onclick = function() {
    document.getElementById('instructionsModal').style.display = 'flex';
};

// Función para cerrar el modal
function closeModal() {
    document.getElementById('instructionsModal').style.display = 'none';
}
</script>

<style>
    .modal {
    display: none; /* Ocultar modal por defecto */
    position: fixed; 
    top: 0; 
    left: 0; 
    width: 100%; 
    height: 100%; 
    background-color: rgba(0, 0, 0, 0.5); 
    justify-content: center; 
    align-items: center; 
    z-index: 1000; /* Asegúrate de que esté por encima de otros elementos */
}
</style>


</div>