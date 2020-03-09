Public Class Form1
    Public gebruikersnaam As String


    Private Sub Form1_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        lblGebruikersnaam.Text = gebruikersnaam
    End Sub

    Private Sub Button1_Click(sender As Object, e As EventArgs) Handles Button1.Click
        Me.Hide()
        Login.txtGebruikersnaam.Text = ""
        Login.txtWachtwoord.Text = ""
        Login.Show()
    End Sub
End Class
