<div class="" id="tchat">
  <div class="">
    {{message}}
  </div>
  {{reverser}}
  <div class="">
    <input type="text" name="" value="" v-model="talk" v-on:keyup.enter="ok">

  </div>
</div>
<div  style="display:none" id="infos">
je t'aime pas
</div>

<div id="todo-list-example">
<input
v-model="newTodoText"
v-on:keyup.enter="addNewTodo"
placeholder="Add a todo"
>
<ul>
<li
  is="todo-item"
  v-for="(todo, index) in todos"
  v-bind:key="todo"
  v-bind:title="todo"
  v-on:remove="todos.splice(index, 1)"
></li>
</ul>
</div>

<script type="text/javascript">
Vue.component('todo-item', {
template: `
<li>
{{ title }}
<button v-on:click="$emit('remove')">X</button>
</li>
`,
props: ['title']
})
new Vue({
el: '#todo-list-example',
data: {
newTodoText: '',
todos: [
'Do the dishes',
'Take out the trash',
'Mow the lawn'
]
},
methods: {
addNewTodo: function () {
this.todos.push(this.newTodoText)
this.newTodoText = ''
}
}
})
</script>

<script type="text/javascript">
var app= new Vue({
  el:'#tchat',
  data:{
    message:'',
    talk:'',
  },
  methods:{
    ok:function(){
      this.message=this.talk+' ok';

    }
  },
computed:{
  reverser: function(){

    return this.message+"ah bon";

  }
}
})

</script>
