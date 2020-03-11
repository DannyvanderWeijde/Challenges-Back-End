var lists = document.getElementsByClassName("planningTasks");

function sort(id){
	for(i = 0; lists.length > i; i++){
		if(id == lists[i].id){
			var activeContainer = lists[i];
		}
	}
}