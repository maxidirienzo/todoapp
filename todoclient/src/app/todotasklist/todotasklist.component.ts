import {Component, OnInit} from '@angular/core';
import {TodotaskService} from "../services/todotask.service";
import {ITodoTask} from "../interfaces/ITodoTask";
import {disableDebugTools} from "@angular/platform-browser";
import {Router} from "@angular/router";

@Component({
  selector: 'app-todotasklist',
  templateUrl: './todotasklist.component.html',
  styleUrls: ['./todotasklist.component.scss']
})
export class TodotasklistComponent implements OnInit {
  public todotasks: ITodoTask[];

  constructor(
    private todotaskService: TodotaskService,
    private router: Router
  ) {
  }

  ngOnInit() {
    this.todotaskService.getTodotasks().subscribe(res => {
      this.todotasks = res;
    })
  }

  toggleFinished(todotask: ITodoTask) {
    this.todotaskService.toggleFinished(todotask).subscribe(
      ret => {
        todotask.finished = ret.finished;
      },
      err => {
        // server error, rollback status
        todotask.finished = todotask.finished == 1 ? 0 : 1;
      });
  }

  onUpdate(todotask: ITodoTask) {
    this.router.navigate(['/update/' + todotask.id]);
  }

  onDelete(todotask: ITodoTask) {
    this.todotaskService.deleteTodotasks(todotask).subscribe(
      ret => {
        if (ret.success) {
          const ix = this.todotasks.indexOf(todotask);
          if (ix >=0) {
            this.todotasks.splice(ix, 1);
          }
        }
        else {
          alert('The todo task could not be deleted');
        }
      },
      err => {
        // server error, rollback status
        alert('An unexpected error while deleting your todo task as occurred');
      }
    );
  }
}
