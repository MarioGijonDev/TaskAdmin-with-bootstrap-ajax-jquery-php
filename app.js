
let edit = false;

$(document).ready(()=>{

    console.log('JQuery esta funcionando');

    $('#task-result').hide();

    fetchTasks();

    $('#search').keyup(()=>{

        if($('#search').val()){

            let searchValue = $('#search').val();
            
            //WITH JQUERY AJAX
            $.ajax({
                url: 'task-search.php',
                type: 'POST',
                data: {searchValue},
                success: (response)=>{

                    let tasks = JSON.parse(response);

                    if(tasks.length === 0){

                        $('#task-result').hide();

                    }else{

                        let template = '';

                        template += 
                        `<table class="table ">
                            <thead>
                                <tr>
                                    <td>Id</td>
                                    <td>Name</td>
                                    <td>Description</td>
                                    <td>Options</td>
                                </tr>
                            </thead>`;

                        tasks.forEach(task => {
                            //template += `<li>${task.name}</li>`;
                            template +=
                                `
                                <tr taskId="${task.id}">
                                    <td>${task.id}</td>
                                    <td>
                                        <a style="cursor: pointer;" class="task-item">${task.name}</a>
                                    </td>
                                    <td>${task.description}</td>
                                    <td>
                                        <button class="btn btn-danger task-delete">DELETE</button>
                                    </td>
                                </tr>
                                `
                        });

                        template += "</table>"
                        $('#container').html(template);
                        $('#task-result').show();
                    }

                    fetchTasks();
                }
            });

        }else{
            $('#task-result').hide();
        }
    });

    $('#task-form').submit((e)=>{
        
        const postData = {
            name: $('#name').val(),
            description: $('#description').val(),
        }
        
        let url = edit ? 'task-edit.php' : 'task-add.php' ;
        
        // With JQuery
        $.post(url, postData, (response)=>{
            console.log(response);
            fetchTasks();
            $('#task-form').trigger('reset');
            $('#task-result').hide();
        })

        edit = false;
        
        e.preventDefault();
        
    })

    $(document).on('click', '.task-delete', (e)=>{
        if(confirm('Are you sure yo want to delete it?')){
            let element = $(e.target)[0].parentNode.parentNode;
            let id = $(element).attr('taskId');
            
            //WITH JQUERY
            $.post('task-delete.php', {id}, (response)=>{
                console.log(response);
                fetchTasks();
                $('#task-result').hide();
            })
        }
    })

    $(document).on('click', '.task-item', (e)=>{
        let element = $(e.target)[0].parentNode.parentNode;
        let id = $(element).attr('taskId');
        //WITH JQUERY
        $.post('task-single.php', {id}, (response)=>{
            const task = JSON.parse(response);
            console.log(task);
            $('#name').val(task.name);
            $('#description').val(task.description);
            edit = true;
            $('#task-result').hide();
        })
    })

    function fetchTasks(){
        $.ajax({
            url: 'task-list.php',
            type: 'GET',
            success: (response)=>{
                let tasks = JSON.parse(response);
                let template = '';
                tasks.forEach(task => {
                    template += `
                        <tr taskId="${task.id}">
                            <td>${task.id}</td>
                            <td>
                                <a style="cursor: pointer;" class="task-item">${task.name}</a>
                            </td>
                            <td>${task.description}</td>
                            <td>
                                <button class="btn btn-danger task-delete">DELETE</button>
                            </td>
                        </tr>
                    `
                })
                $('#tasks').html(template);
            }
        })
    }

    

});