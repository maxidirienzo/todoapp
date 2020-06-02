import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TodotaskformComponent } from './todotaskform.component';

describe('TodotaskformComponent', () => {
  let component: TodotaskformComponent;
  let fixture: ComponentFixture<TodotaskformComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TodotaskformComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TodotaskformComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
