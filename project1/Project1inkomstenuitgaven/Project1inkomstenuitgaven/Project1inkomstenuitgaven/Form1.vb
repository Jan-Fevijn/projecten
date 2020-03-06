Imports System.Data
Imports MySql.Data
Imports MySql.Data.MySqlClient
Imports System.Configuration
Imports System.IO
Imports System.ComponentModel

Public Class Form1
    Dim list As New List(Of String)
    Public conn As MySqlConnection
    Dim reader As MySqlDataReader
    Dim reader2 As MySqlDataReader
    Public connstring As String = "server=localhost;Port=3307;database=Project1;uid=root;password=usbw; "



    Private Sub Form1_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        conn = New MySqlConnection(connstring)

        conn.Open()

        Dim mySelectQuery As String = "select * from verrichting"


    End Sub

    Private Sub InkomstenToolStripMenuItem_Click(sender As Object, e As EventArgs) Handles InkomstenToolStripMenuItem.Click

        Dim myCommand As New MySqlCommand("INSERT INTO verrichting (bedrag,datum,idtypeverrichting,idpersoon ) values ('" & NumericUpDown1.Value & "','" & DateTimePicker1.Value.ToString("yyyy/M/dd") & "','" & TextBox2.Text & "','" & NumericUpDown2.Value & "')", conn)
        reader = myCommand.ExecuteReader

        MsgBox("inkomst toegevoegd")

    End Sub
    Private Sub PrintToolStripMenuItem_Click(sender As Object, e As EventArgs) Handles PrintToolStripMenuItem.Click
        Dim i As Integer
        i = 0

        Dim mySelectQuery As New MySqlCommand("select *  from alleinfoverrichtingen", conn)
        reader2 = mySelectQuery.ExecuteReader

        If (SaveBestand.ShowDialog = DialogResult.OK) Then
            FileOpen(2, SaveBestand.FileName, OpenMode.Output)
            'For Each punt In reader2


            '    MessageBox.Show(punt.GetXml)
            'Next
            Do Until i = 1
                reader2.Read()
                MessageBox.Show(reader2.Item(4) & " " & reader2.Item(5))
                PrintLine(2, (reader2.Item(4) & " " & reader2.Item(5)) & System.Environment.NewLine)
                i = i + 1
            Loop

            While reader2.Read()

                MessageBox.Show(reader2.Item(0) & " " & reader2.Item(1) & " " & reader2.Item(3))
                PrintLine(2, (reader2.Item(0) & " " & reader2.Item(1) & " " & reader2.Item(3)))
            End While

            FileClose()
        End If


    End Sub
End Class
