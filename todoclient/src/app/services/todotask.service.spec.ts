import { TestBed } from '@angular/core/testing';

import { TodotaskService } from './todotask.service';

describe('TodotaskService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: TodotaskService = TestBed.get(TodotaskService);
    expect(service).toBeTruthy();
  });
});
