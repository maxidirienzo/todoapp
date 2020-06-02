import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {AppRoutingModule} from './app-routing.module';
import {AppComponent} from './app.component';
import {FormsModule} from "@angular/forms";
import {HttpClientModule} from "@angular/common/http";
import { TodotaskComponent } from './todotask/todotask.component';
import { TodotasklistComponent } from './todotasklist/todotasklist.component';
import { TodotaskformComponent } from './todotaskform/todotaskform.component';

@NgModule({
  declarations: [
    AppComponent,
    TodotaskComponent,
    TodotasklistComponent,
    TodotaskformComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpClientModule,
    AppRoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule {
}
