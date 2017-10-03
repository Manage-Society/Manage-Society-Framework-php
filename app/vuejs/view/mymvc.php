<style media="screen">
  .hide{
    display:none;
  }
</style>
<div class="" id="todo">
  <input type="text" v-model="newtodo" @keyup.enter='addtodo' name="" value="" >
  <div class="">
    <ul class="todo-list">
      <li v-for="todo in todos"
        :key="todo.id"
        :class="{ completed: todo.completed, editing: todo == editedTodo }"
      >
        <div class="view">
          <!-- <input class="toggle" type="checkbox" v-model="todo.completed"> -->
            <label @dblclick="editTodo(todo)" >{{ todo.title }}</label>
         <button class="destroy" @click="removeTodo(todo)"></button>
        </div>
     <input :class="{ hide: todo != editedTodo }" type="text"
          v-model="todo.title"
          v-todo-focus="todo == editedTodo"
          @blur="doneEdit(todo)"
          @keyup.enter="doneEdit(todo)"
          @keyup.esc="cancelEdit(todo)">
      </li>
    </ul>
  </div>
</div>


<script type="text/javascript">
$(document).ready(function() {
   // Stuff to do as soon as the DOM is ready


var STORAGE_KEY = 'todos-vuejs-2.0'
var todoStorage = {
fetch: function () {
  var todos = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]')
  todos.forEach(function (todo, index) {
    todo.id = index
  })
  todoStorage.uid = todos.length
  return todos
},
save: function (todos) {
  localStorage.setItem(STORAGE_KEY, JSON.stringify(todos))
}
}

  var app=new Vue({
    el:'#todo',
    data:{
      newtodo:'',
      editedTodo: null,
      isActive: false,
      todos: todoStorage.fetch(),
    },
    watch:{
      todos:{
        handler: function (todos) {
          todoStorage.save(todos)
        },
        deep: true
      }
    },
    methods:{
      addtodo:function(){
        var value = this.newtodo && this.newtodo.trim()
        if (!value) {
          return
        }

        this.todos.push({
          id: todoStorage.uid++,
          title: value,
          completed: false
        })
        this.newtodo='';
      },

      doneEdit: function (todo) {
        if (!this.editedTodo) {
          return
        }
        this.editedTodo = null
        todo.title = todo.title.trim()
        if (!todo.title) {
          this.removeTodo(todo)
        }
      },
      removeTodo:function(todo){
        this.todos.splice(this.todos.indexOf(todo), 1)
      },
      editTodo: function (todo) {

        this.beforeEditCache = todo.title
        this.editedTodo = todo
      },
    },
    directives: {
      'todo-focus': function (el, binding) {
        if (binding.value) {
          el.focus()
        }
      }
    }
  })
  });
</script>
