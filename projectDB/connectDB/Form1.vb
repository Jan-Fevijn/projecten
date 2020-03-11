Public Class Form1
    Public dt As New DataTable
    Public dtBackup As New DataTable

    Private Sub Form1_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        Dim p As New Persoon()
        p.Naam = "De Kesel"
        p.Voornaam = "Hannes"
        p.Wachtwoord = "test"
        p.Add()

        dt = Persoon.GetAll(5, 5)
        dtBackup = Persoon.GetAll(5, 5)

        DataGridView1.DataSource = dt
        werdaangepast()


    End Sub

    Private Sub werdaangepast()
        For i = 0 To dt.Rows.Count - 1

            If dt.Rows(i).RowState <> DataRowState.Unchanged Then
                Select Case dt.Rows(i).RowState
                    Case 4
                        Dim p As New Persoon()
                        p.Naam = dt.Rows(i).Item("Naam")
                        p.Voornaam = dt.Rows(i).Item("Voornaam")
                        p.Wachtwoord = dt.Rows(i).Item("wachtwoord")
                        p.Add()
                    Case 8
                        MessageBox.Show("werd gewist")
                        Persoon.Delete(dtBackup.Rows(i).Item("IDPersoon"))
                    Case 16
                        Dim p = Persoon.GetOne(dt.Rows(i).Item("IDPersoon"))
                        p.Naam = dt.Rows(i).Item("Naam")
                        p.Voornaam = dt.Rows(i).Item("Voornaam")
                        p.Wachtwoord = dt.Rows(i).Item("wachtwoord")
                        p.Update()
                End Select
            End If
        Next
    End Sub

    Private Sub Button1_Click(sender As Object, e As EventArgs) Handles Button1.Click
        werdaangepast()
    End Sub

    Private Sub Button2_Click(sender As Object, e As EventArgs) Handles Button2.Click
        Dim p As New Persoon()
        p.Naam = "Borre"
        p.Voornaam = "Lorre"
        p.Wachtwoord = "ikweetnie"

        p.Add()

        p.Naam = "Borren"
        p.Update()
    End Sub
End Class
