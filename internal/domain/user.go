package domain

type User struct {
	Id       int    `db:"id"`
	Name     string `db:"name"`
	Email    string `db:"email"`
	Password string `db:"password"`
	Course   string `db:"course"`
	Year     int    `db:"year"`
	Role     string `db:"role"`
}
