import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {environment} from "../../environments/environment";
import {Observable} from "rxjs";
import {ISuccess, ITodoTask} from "../interfaces/ITodoTask";
import {catchError} from "rxjs/operators";

@Injectable({
  providedIn: 'root'
})
export class TodotaskService {

  constructor(
    public http: HttpClient
  ) { }

  public getTodotasks(): Observable<ITodoTask[]>{
    return this.http.get<ITodoTask[]>(environment.apiEndpoint + 'todotasks');
  }

  public getTodotask(todotask_id): Observable<ITodoTask>{
    return this.http.get<ITodoTask>(environment.apiEndpoint + 'todotask/' + todotask_id);
  }

  public toggleFinished(todotask: ITodoTask): Observable<ITodoTask>{
    return this.http.put<ITodoTask>(environment.apiEndpoint + 'todotask/put/' + todotask.id, {finished: todotask.finished});
  }

  public deleteTodotasks(todotask: ITodoTask): Observable<ISuccess>{
    return this.http.delete<ISuccess>(environment.apiEndpoint + 'todotask/delete/' + todotask.id);
  }

  putTodotask(todotask: ITodoTask) {
    return this.http.put<ITodoTask>(environment.apiEndpoint + 'todotask/put/' + todotask.id, todotask);
  }

  postTodotask(todotask: ITodoTask) {
    return this.http.post<ITodoTask>(environment.apiEndpoint + 'todotask/post', todotask);
  }

  storeTodotask(todotask: ITodoTask) {
    if (todotask.id) {
      // we must update the task
      return this.putTodotask(todotask);
    }
    else {
      // we must create a new task
      return this.postTodotask(todotask);
    }
  }
}
