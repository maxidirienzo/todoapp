import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TodotasklistComponent } from './todotasklist.component';

describe('TodotasklistComponent', () => {
  let component: TodotasklistComponent;
  let fixture: ComponentFixture<TodotasklistComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TodotasklistComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TodotasklistComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
