var lists = document.getElementsByClassName("planningTasks");

//Get the list that was clicked on and put all the taskContainers in an array.
function getListWithTasks(id){
	var taskContainers = [];
	for(i = 0; lists.length > i; i++){
		if(id == lists[i].id){
			var activeContainer = lists[i];
		}
	}
	for(a = 0; activeContainer.childElementCount > a; a++){
		if(activeContainer.children[a].className == "planningTaskContainer"){
			taskContainers.push(activeContainer.children[a]);
		}
	}
	sort(taskContainers);
}

//Sort the list on the status. If it is already from done to not done it reverses it.
function sort(taskContainers,reverseSwitch = false){
	var switching = true;
	var reverse = 0;
	while(switching){
		switching = false;
		for(b = 0; taskContainers.length > b; b++){
			var shouldSwitch = false;
			var currentTask = taskContainers[b].children[2];
			if(taskContainers[b + 1]){
				var nextTask = taskContainers[b + 1].children[2];
				if(currentTask && nextTask){
					if(reverseSwitch == true){
						if(currentTask.innerHTML.toLowerCase() < nextTask.innerHTML.toLowerCase()){
							shouldSwitch = true;
						}
					}else{
						if(currentTask.innerHTML.toLowerCase() > nextTask.innerHTML.toLowerCase()){
							shouldSwitch = true;
						}
					}
				}
				if(shouldSwitch){
					var currentTaskInnerHTML = taskContainers[b].innerHTML;
					var nextTaskInnerHTML = taskContainers[b + 1].innerHTML;
					taskContainers[b].innerHTML = nextTaskInnerHTML;
					taskContainers[b + 1].innerHTML = currentTaskInnerHTML;
					switching = true;
					reverse++;
				}
			}
		}
	}
	if(reverse == 0){
		var reverseSwitch = true
		sort(taskContainers,reverseSwitch);
	}
}