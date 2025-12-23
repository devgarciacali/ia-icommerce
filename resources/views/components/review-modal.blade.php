<div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-lg w-11/12 md:w-1/2 max-h-[80vh] overflow-y-auto shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Review del Producto Con IA</h2>
        <div id="modal-content" class="text-gray-800 whitespace-pre-line"></div>
        <div class="mt-6 text-right">
            <button onclick="closeModal()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Cerrar</button>
        </div>
    </div>
</div>

<script>
    function openModal(content) {
        const modal = document.getElementById('modal');
        const modalContent = document.getElementById('modal-content');
        modalContent.innerText = content;
        modal.classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }
    // Interceptar todos los formularios
    document.addEventListener('DOMContentLoaded', () => {
        const forms = document.querySelectorAll('form[action="/product-review"]');
        forms.forEach(form => {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const formData = new FormData(form);
                const productId = formData.get('product_id');
                // Indicador de carga (puedes mejorarlo con un spinner)
                openModal('Cargando...');
                try {
                    const response = await fetch('/product-review', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ product_id: productId })
                    });
                    const data = await response.json();
                    if (data.review) {
                        openModal(data.review);
                    } else {
                        openModal('La IA no pudo generar una reseña en este momento.');
                    }
                } catch (err) {
                    openModal('Ocurrió un error al contactar a la IA.');
                    console.error(err);
                }
            });
        });
    });
</script>