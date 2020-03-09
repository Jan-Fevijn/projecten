<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class Login
    Inherits System.Windows.Forms.Form

    'Form overrides dispose to clean up the component list.
    <System.Diagnostics.DebuggerNonUserCode()> _
    Protected Overrides Sub Dispose(ByVal disposing As Boolean)
        Try
            If disposing AndAlso components IsNot Nothing Then
                components.Dispose()
            End If
        Finally
            MyBase.Dispose(disposing)
        End Try
    End Sub

    'Required by the Windows Form Designer
    Private components As System.ComponentModel.IContainer

    'NOTE: The following procedure is required by the Windows Form Designer
    'It can be modified using the Windows Form Designer.  
    'Do not modify it using the code editor.
    <System.Diagnostics.DebuggerStepThrough()> _
    Private Sub InitializeComponent()
        Me.txtGebruikersnaam = New System.Windows.Forms.TextBox()
        Me.txtWachtwoord = New System.Windows.Forms.TextBox()
        Me.Button1 = New System.Windows.Forms.Button()
        Me.SuspendLayout()
        '
        'txtGebruikersnaam
        '
        Me.txtGebruikersnaam.Location = New System.Drawing.Point(26, 12)
        Me.txtGebruikersnaam.Name = "txtGebruikersnaam"
        Me.txtGebruikersnaam.Size = New System.Drawing.Size(100, 20)
        Me.txtGebruikersnaam.TabIndex = 0
        '
        'txtWachtwoord
        '
        Me.txtWachtwoord.Location = New System.Drawing.Point(26, 48)
        Me.txtWachtwoord.Name = "txtWachtwoord"
        Me.txtWachtwoord.PasswordChar = Global.Microsoft.VisualBasic.ChrW(42)
        Me.txtWachtwoord.Size = New System.Drawing.Size(100, 20)
        Me.txtWachtwoord.TabIndex = 1
        '
        'Button1
        '
        Me.Button1.Location = New System.Drawing.Point(26, 88)
        Me.Button1.Name = "Button1"
        Me.Button1.Size = New System.Drawing.Size(75, 23)
        Me.Button1.TabIndex = 2
        Me.Button1.Text = "Button1"
        Me.Button1.UseVisualStyleBackColor = True
        '
        'Login
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.ClientSize = New System.Drawing.Size(284, 261)
        Me.Controls.Add(Me.Button1)
        Me.Controls.Add(Me.txtWachtwoord)
        Me.Controls.Add(Me.txtGebruikersnaam)
        Me.Name = "Login"
        Me.Text = "Login"
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub

    Friend WithEvents txtGebruikersnaam As TextBox
    Friend WithEvents txtWachtwoord As TextBox
    Friend WithEvents Button1 As Button
End Class
