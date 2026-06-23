package domain

type UserLogin struct {
	Email    string `json:"email" binding:"required,email"`
	Password string `json:"password" binding:"required,min=5",max=32`
}

type UserCreate struct {
	Name     string `json:"name"     binding:"required,min=2,max=100"`
	Email    string `json:"email"    binding:"required,email"`
	Password string `json:"password" binding:"required,min=6,max=32"`
	Course   string `json:"course"   binding:"required,min=2"`
	Year     string `json:"year"     binding:"required,oneof=1 2 3 4 5"`
}
