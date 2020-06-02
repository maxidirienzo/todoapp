import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import {ITodoTask} from "../interfaces/ITodoTask";

@Component({
  selector: 'app-todotask',
  templateUrl: './todotask.component.html',
  styleUrls: ['./todotask.component.scss']
})
export class TodotaskComponent implements OnInit {

  @Input() todotask: ITodoTask;
  @Output() onToggleFinished = new EventEmitter();
  @Output() onDelete = new EventEmitter();
  @Output() onUpdate = new EventEmitter();

  constructor() { }

  ngOnInit() {
  }

  toggleFinished($event: any) {
    this.todotask.finished = $event ? 1 : 0;
    this.onToggleFinished.emit();
  }

  doDelete() {
    this.onDelete.emit();
  }

  doUpdate() {
    this.onUpdate.emit();
  }
}
