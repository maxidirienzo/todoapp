export interface ITodoTask {
  id?: number;
  task: string;
  task_description: string;
  finished?: number;
}

export interface ISuccess {
  success: boolean;
}
