import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {TodotaskformComponent} from "./todotaskform/todotaskform.component";
import {TodotasklistComponent} from "./todotasklist/todotasklist.component";


const routes: Routes = [
  {
    path: '',
    component: TodotasklistComponent,
  },
  {
    path: 'add',
    component: TodotaskformComponent,
  },
  {
    path: 'update/:id',
    component: TodotaskformComponent,
  },
  {
    path: '**',
    component: TodotasklistComponent,
  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
