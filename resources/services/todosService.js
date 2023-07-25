import http from "./http"

export const getTodosService = async () => {
  const response = await http.get('/todos');
  return response.data;
}

export const updateTodoService = async (body) => {
  const response = await http.put(`/todos/${body.id}`, body);
  return response.data;
}

export const createTodoService = async (body) => {
  const response = await http.post('/todos', body);
  return response;
}

export const deleteTodoService = async (id) => {
  const response = await http.delete(`/todos/${id}`);
  return response;
}