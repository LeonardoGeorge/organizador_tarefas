document.getElementById('addTaskButton').addEventListener('click', async () => {
    const taskInput = document.getElementById('taskInput');
    const datePicker = document.getElementById('datePicker');
    const taskText = taskInput.value.trim();
    const selectedDate = datePicker.value;

    if (!taskText || !selectedDate) {
        alert('Preencha todos os campos!');
        return;
    }

    try {
        const response = await fetch('http://localhost/organizador_tarefas/inserir_tarefa.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ data: selectedDate, tarefa: taskText })
        });

        const result = await response.json();
        
        if (result.success) {
            const listItem = document.createElement('li');
            listItem.textContent = `${taskText} - ${selectedDate}`;
            document.getElementById('taskList').appendChild(listItem);
            
            taskInput.value = '';
            datePicker.value = '';
        } else {
            alert(result.error || 'Erro desconhecido');
        }
    } catch (error) {
        console.error('Erro:', error);
        alert('Falha na comunicação com o servidor');
    }
});

// Sidebar (mantenha apenas este)
const sidebar = document.getElementById('sidebar');
document.getElementById('toggleSidebar').addEventListener('click', () => {
    sidebar.classList.toggle('expanded');
});