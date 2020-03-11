Imports System.Configuration
Imports MySql.Data.MySqlClient
Public Class Persoon
    Private connStr As String = "server=localhost;user=root;database=entity;port=3307;password=usbw;"
    Private conn As New MySqlConnection(connStr)

    Private _IDPersoon As Integer
    Private _Wachtwoord As String
    Private _Voornaam As String
    Private _Naam As String
    Private _IsActive As Integer

    Public Sub New()
    End Sub

    Public Sub New(iDPersoon As Integer, voornaam As String, naam As String, wachtwoord As String)
        Me.IDPersoon = iDPersoon
        Me.Voornaam = voornaam
        Me.Naam = naam
        Me.Wachtwoord = wachtwoord
        'bij de aanmaak van het object is deze niet upgedate
    End Sub



#Region "properties"
    Public Property IDPersoon() As Integer
        Get
            Return _IDPersoon
        End Get
        Set(ByVal value As Integer)
            _IDPersoon = value
        End Set
    End Property


    Public Property Voornaam() As String
        Get
            Return _Voornaam
        End Get
        Set(ByVal value As String)
            _Voornaam = value
        End Set
    End Property


    Public Property Naam() As String
        Get
            Return _Naam
        End Get
        Set(ByVal value As String)
            _Naam = value
        End Set
    End Property


    Public Property Wachtwoord() As String
        Get
            Return _Wachtwoord
        End Get
        Set(ByVal value As String)
            _Wachtwoord = value
        End Set
    End Property


    Public Property IsActive() As Integer
        Get
            Return _IsActive
        End Get
        Set(ByVal value As Integer)
            _IsActive = value
        End Set
    End Property

#End Region

#Region "Add"
    ''' <summary>
    ''' Add een nieuwe persoon aan de databank
    ''' </summary>
    Public Sub Add()
        Using conn = New MySqlConnection(connStr)
            Dim query As String = "INSERT INTO " &
                "`persoon` (`Naam`,`Voornaam`,`wachtwoord`)" &
                "VALUES (@naam,@voornaam,@wachtwoord)"

            conn.Open()

            Try
                Using cmd As New MySqlCommand(query, conn)
                    cmd.Parameters.Add("@naam", MySqlDbType.VarChar, 45).Value = Naam
                    cmd.Parameters.Add("@voornaam", MySqlDbType.VarChar, 45).Value = Voornaam
                    cmd.Parameters.Add("@wachtwoord", MySqlDbType.VarChar, 45).Value = Wachtwoord
                    cmd.ExecuteNonQuery()

                    IDPersoon = Convert.ToInt32(cmd.LastInsertedId)
                End Using
            Catch ex As Exception
                If (ex.Message.Contains("UNIEK")) Then
                    MessageBox.Show("fout - dubbel persoon")
                End If
            End Try



            conn.Close()
        End Using
    End Sub

#End Region

#Region "update"
    Public Sub Update()
        Using conn = New MySqlConnection(connStr)
            Dim query As String = "UPDATE `persoon` " &
                "SET `Naam` = @naam ,`Voornaam` = @voornaam,`wachtwoord` = @wachtwoord " &
                "WHERE IDPersoon = @IDPersoon"

            conn.Open()

            Try
                Using cmd As New MySqlCommand(query, conn)
                    cmd.Parameters.Add("@naam", MySqlDbType.VarChar, 45).Value = Naam
                    cmd.Parameters.Add("@voornaam", MySqlDbType.VarChar, 45).Value = Voornaam
                    cmd.Parameters.Add("@wachtwoord", MySqlDbType.VarChar, 45).Value = Wachtwoord
                    cmd.Parameters.Add("@IDPersoon", MySqlDbType.Int32, 4).Value = IDPersoon
                    cmd.ExecuteNonQuery()
                End Using
            Catch ex As Exception
                If (ex.Message.Contains("UNIEK")) Then
                    MessageBox.Show("fout - dubbel persoon")
                End If
            End Try



            conn.Close()
        End Using
    End Sub
#End Region

#Region "delete"
    Public Shared Sub Delete(ByVal ID As Integer)
        Using conn = New MySqlConnection("server=localhost;user=root;database=entity;port=3307;password=usbw;")
            Dim query As String = "UPDATE `persoon` " &
                "SET `isActive` = 0 " &
                "WHERE IDPersoon = @IDPersoon"

            conn.Open()

            Try
                Using cmd As New MySqlCommand(query, conn)
                    cmd.Parameters.Add("@IDPersoon", MySqlDbType.Int32, 4).Value = ID
                    cmd.ExecuteNonQuery()
                End Using
            Catch ex As Exception
                MessageBox.Show("Persoon verwijderen mislukt." & " " & ex.Message)
            End Try

            conn.Close()
        End Using
    End Sub
#End Region

#Region "select"
    ''' <summary>
    ''' Vraag 1 persoon op
    ''' </summary>
    ''' <param name="ID"></param>
    ''' <returns></returns>
    Public Shared Function GetOne(ByVal ID As Integer) As Persoon
        Dim Pers As New Persoon()

        Using conn = New MySqlConnection("server=localhost;user=root;database=entity;port=3307;password=usbw;")
            Dim query As String = "SELECT * " &
                "FROM `persoon`" &
                "Where IDPersoon = @IDPersoon"

            conn.Open()

            Try
                Using cmd As New MySqlCommand(query, conn)
                    cmd.Parameters.Add("@IDPersoon", MySqlDbType.Int32, 4).Value = ID

                    Using reader = cmd.ExecuteReader(CommandBehavior.CloseConnection)
                        If reader.Read() Then
                            Pers.IDPersoon = Convert.ToInt32(reader("IDPersoon"))
                            Pers.Naam = reader("Naam").ToString()
                            Pers.Voornaam = reader("Voornaam").ToString()
                            Pers.Wachtwoord = If(IsDBNull(reader("Wachtwoord")), Nothing, reader("Wachtwoord").ToString())
                        End If
                    End Using

                End Using

                Return Pers
            Catch ex As Exception
                MessageBox.Show(ex.Message)
                Return Pers
            End Try
        End Using
    End Function

    Public Shared Function GetAll(ByVal pageNo As Integer, ByVal pageSize As Integer) As DataTable
        Using conn = New MySqlConnection("server=localhost;user=root;database=entity;port=3307;password=usbw;")
            Dim datatable As New DataTable()
            Dim totaalAantalRecords As Integer

            Dim query As String = "SELECT COUNT(*) " &
                "FROM `persoon` " &
                "Where isActive = 1"

            conn.Open()

            Using cmd = New MySqlCommand(query, conn)
                'cmd.Parameters.Add("")
                totaalAantalRecords = Convert.ToInt32(cmd.ExecuteScalar())
            End Using

            Dim pagesCount As Integer = CInt(Math.Ceiling(CDbl(totaalAantalRecords / pageSize)))
            pageNo = If(pageNo > pagesCount, pagesCount, pageNo)
            Dim start As Integer = pageSize * pageNo - pageSize
            start = If(start < 0, 0, start)

            query = "Select IDPersoon, naam, voornaam, wachtwoord " &
                " FROM `persoon`" &
                " Where isActive = 1 " &
                " LIMIT @start, @pageSize;"

            Using cmd = New MySqlCommand(query, conn)
                cmd.Parameters.Add("@start", MySqlDbType.Int32, 4).Value = start
                cmd.Parameters.Add("@pageSize", MySqlDbType.Int32, 4).Value = pageSize

                Using reader = cmd.ExecuteReader(CommandBehavior.CloseConnection)
                    datatable.Load(reader)
                End Using

                Return datatable
            End Using

        End Using



    End Function
#End Region
End Class
