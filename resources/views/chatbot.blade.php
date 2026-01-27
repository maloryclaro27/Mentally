@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">💚 Chatbot de Salud Mental</h4>
                </div>
                
                <div class="card-body" id="chatContainer" style="height: 400px; overflow-y: auto; background-color: #f8f9fa;">
                    <!-- Messages will appear here -->
                </div>
                
                <div class="card-footer">
                    <form id="chatForm" class="d-flex gap-2">
                        <input type="text" id="userMessage" class="form-control" placeholder="Escribe tu mensaje..." required>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('chatForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = document.getElementById('userMessage').value;
        
        // Add user message to chat
        document.getElementById('chatContainer').innerHTML += `
            <div class="mb-2 text-end">
                <span class="badge bg-primary">${message}</span>
            </div>
        `;
        
        document.getElementById('userMessage').value = '';
        
        // Send to backend (create route if needed)
        // const response = await fetch('/api/chatbot', { method: 'POST', body: JSON.stringify({message}) });
    });
</script>
@endsection