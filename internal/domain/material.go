package domain

type Material struct {
	Id          int
	Title       string
	Description string
	User_id     string
	File_Url    string
	Type        string
	Point       string
	Created_at  string
}

type MaterialCreated struct {
	Title       string `json:"title" binding:"required min=2 max=50"`
	Description string `json:"description"`
	User_id     string `json:"user_id" binding:"required"`
	File_Url    string `json:"file_url" binding:"required"`
	Type        string `json:"type_file" binding:"required"`
	Created_at  string `json:"time_created"`
}
