<!-- AI Chat Widget -->
<div id="ai-chat-widget" class="position-fixed bottom-0 end-0 m-4" style="z-index: 2000;">
    <button id="ai-chat-toggle" class="btn btn-dark rounded-circle shadow-lg" style="width: 60px; height: 60px;">
        <i class="bi bi-robot fs-3"></i>
    </button>

    <div id="ai-chat-box" class="card shadow-lg d-none" style="width: 350px; height: 500px; bottom: 80px; position: absolute; right: 0;">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Mygate AI Assistant</h6>
            <button class="btn btn-sm text-white" id="ai-chat-close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="card-body p-0 d-flex flex-column" style="height: calc(100% - 50px); overflow: hidden;">
            <div id="ai-messages" class="flex-grow-1 p-3" style="font-size: 0.9rem; overflow-y: auto; display: flex; flex-direction: column;">
                <div class="message system bg-light p-2 rounded mb-2">
                    Hello! How can I help you with your property management today?
                </div>
            </div>
            <div class="p-3 border-top bg-light">
                <div class="input-group">
                    <input type="text" id="ai-input" class="form-control border-0 bg-white" placeholder="Ask anything...">
                    <button id="ai-send" class="btn btn-primary"><i class="bi bi-send"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #ai-messages::-webkit-scrollbar { width: 4px; }
    #ai-messages::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }
    .message.user { background: var(--mygate-blue); align-self: flex-end; margin-left: 20px; }
    .message.system { background: #f0f2f5; align-self: flex-start; margin-right: 20px; }
    .message { margin-bottom: 10px; padding: 10px; border-radius: 12px; max-width: 85%; }
</style>

    <!-- Markdown Support -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#ai-chat-toggle').on('click', () => $('#ai-chat-box').toggleClass('d-none'));
        $('#ai-chat-close').on('click', () => $('#ai-chat-box').addClass('d-none'));

        function appendMessage(role, text) {
            // Use marked for system messages
            const formattedText = role === 'system' ? marked.parse(text) : text;
            const msgHtml = `<div class="message ${role}">${formattedText}</div>`;
            $('#ai-messages').append(msgHtml).scrollTop($('#ai-messages')[0].scrollHeight);
        }

        function showLoading() {
            const loadingHtml = `
                <div id="ai-loading" class="message system bg-light p-2 rounded mb-2" style="width: 60px;">
                    <div class="typing-dots">
                        <span>.</span><span>.</span><span>.</span>
                    </div>
                </div>`;
            $('#ai-messages').append(loadingHtml).scrollTop($('#ai-messages')[0].scrollHeight);
        }

        function hideLoading() {
            $('#ai-loading').remove();
        }

        $('#ai-send').on('click', function() {
            const message = $('#ai-input').val();
            if (!message) return;

            $('#ai-input').val('');
            appendMessage('user', message);
            
            showLoading();

            $.post('/admin/aichat', { message: message }, function(data) {
                hideLoading();
                if (data.response) {
                    appendMessage('system', data.response);
                } else if (data.error) {
                    appendMessage('system', 'Error: ' + data.error);
                }
            }).fail(function() {
                hideLoading();
                appendMessage('system', 'Error: Could not connect to AI service.');
            });
        });

        $('#ai-input').on('keypress', function(e) {
            if (e.which == 13) $('#ai-send').click();
        });
    });
    </script>

    <style>
        .typing-dots { font-weight: bold; font-size: 1.5rem; line-height: 0.5; }
        .typing-dots span { animation: blink 1s infinite; margin: 0 1px; }
        .typing-dots span:nth-child(2) { animation-delay: 0.2s; }
        .typing-dots span:nth-child(3) { animation-delay: 0.4s; }
        @keyframes blink { 0% { opacity: 0; } 50% { opacity: 1; } 100% { opacity: 0; } }
        
        /* Better markdown styles inside chat */
        .message.system p { margin-bottom: 0.5rem; }
        .message.system ul, .message.system ol { margin-bottom: 0.5rem; padding-left: 1.2rem; }
        .message.system code { background: #e9ecef; padding: 2px 4px; border-radius: 4px; }
    </style>

