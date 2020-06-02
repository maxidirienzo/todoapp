import {Component, OnInit} from '@angular/core';
import {ITodoTask} from "../interfaces/ITodoTask";
import {ActivatedRoute, Router} from "@angular/router";
import {TodotaskService} from "../services/todotask.service";

@Component({
  selector: 'app-todotaskform',
  templateUrl: './todotaskform.component.html',
  styleUrls: ['./todotaskform.component.scss']
})
export class TodotaskformComponent implements OnInit {

  public todotask: ITodoTask = {
    task: '',
    task_description: ''
  };

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private todotaskService: TodotaskService
  ) {
  }

  ngOnInit() {
    const todotask_id = this.route.snapshot.paramMap.get('id');
    if (todotask_id) {
      // id is present in the URL, get task from server
      this.todotaskService.getTodotask(todotask_id).subscribe(
        ret => {
          this.todotask = ret;
        },
        err => {
          alert('The requested to-do task could not be loaded from the server');
        }
      )
    };
  }

  submitForm() {
    this.todotaskService.storeTodotask(this.todotask).subscribe(
      ret => {
        this.router.navigate(["/"]);
      },
      err => {
        alert('Please fill in all fields to save the to-do task');
      }
    );
  }
}
